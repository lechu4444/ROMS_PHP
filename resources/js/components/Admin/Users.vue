<template>
    <div class="users">
        <div class="tableFilters">
            <div class="row">
                <div class="col-sm-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <input class="form-control" type="text" v-model="tableData.search" placeholder="Search Table"
                               @input="getUsers()">
                    </div>
                </div>

                <div class="col-sm-1 offset-sm-8">
                    <select class="form-control mb-2" v-model="tableData.length" @change="getUsers()">
                        <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                    </select>
                </div>
            </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{user.name}}</td>
                <td>{{user.surname}}</td>
                <td>{{user.birthday}}</td>
                <td>{{user.email}}</td>
                <td>
                    <a :href="'admin/users/edit/'+user.id" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                    <a href="#" class="btn btn-sm btn-danger" :data-user-id="user.id" @click="deleteUser"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            </tbody>
        </datatable>
        <pagination :pagination="pagination"
                    @prev="getUsers(pagination.prevPageUrl)"
                    @next="getUsers(pagination.nextPageUrl)">
        </pagination>
    </div>
</template>

<script>
    import Datatable from '../Datatable.vue';
    import Pagination from '../Pagination.vue';
    export default {
        components: { datatable: Datatable, pagination: Pagination },
        created() {
            this.getUsers();
        },
        data() {
            let sortOrders = {};
            let columns = [
                {width: '20%', label: 'Imię', name: 'name' },
                {width: '20%', label: 'Nazwisko', name: 'surname' },
                {width: '20%', label: 'Data urodzenia', name: 'birthday' },
                {width: '20%', label: 'Email', name: 'email'},
                {width: '20%', label: 'Akcje', name: 'actions'}
            ];
            columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });
            return {
                users: [],
                columns: columns,
                sortKey: 'name',
                sortOrders: sortOrders,
                perPage: ['10', '20', '30'],
                tableData: {
                    draw: 0,
                    length: 10,
                    search: '',
                    column: 0,
                    dir: 'desc',
                },
                pagination: {
                    lastPage: '',
                    currentPage: '',
                    total: '',
                    lastPageUrl: '',
                    nextPageUrl: '',
                    prevPageUrl: '',
                    from: '',
                    to: ''
                },
            }
        },
        methods: {
            getUsers(url = '/admin/users/get-data') {
                this.tableData.draw++;
                axios.get(url, {params: this.tableData})
                    .then(response => {
                        let data = response.data;
                        if (this.tableData.draw == data.draw) {
                            this.users = data.data.data;
                            this.configPagination(data.data);
                        }
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
            deleteUser(e) {
                let userId = e.currentTarget.getAttribute('data-user-id');
                let url = '/admin/users/delete';
                this.tableData.draw++;
                axios.post(url + '/' + userId, {params: this.tableData})
                    .then(response => {
                        let data = response.data;
                        if (this.tableData.draw == data.draw) {
                            this.getUsers();
                        }
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
            configPagination(data) {
                this.pagination.lastPage = data.last_page;
                this.pagination.currentPage = data.current_page;
                this.pagination.total = data.total;
                this.pagination.lastPageUrl = data.last_page_url;
                this.pagination.nextPageUrl = data.next_page_url;
                this.pagination.prevPageUrl = data.prev_page_url;
                this.pagination.from = data.from;
                this.pagination.to = data.to;
            },
            sortBy(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
                this.tableData.column = this.getIndex(this.columns, 'name', key);
                this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
                this.getUsers();
            },
            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value)
            }
        }
    };
</script>