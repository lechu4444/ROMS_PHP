<style lang="scss">
.pagination {
    justify-content: flex-end !important;
    .page-stats {
        align-items: center;
        margin-right: 5px;
    }
    i {
        color: #3273dc !important;
    }
}
</style>

<template>
    <nav aria-label="Page navigation example">
        <div class="row">
            <div class="col-6">
                <span class="page-stats">{{pagination.from}} - {{pagination.to}} of {{pagination.total}}</span>
            </div>
            <div class="col-6">
                <ul class="pagination">
                    <li v-if="pagination.prevPageUrl" class="page-item">
                        <a class="page-link" @click="$emit('prev');">
                            Prev
                        </a>
                    </li>
                    <li v-else class="page-item disabled">
                        <a class="page-link" @click="$emit('prev');">
                            Prev
                        </a>
                    </li>

                    <li v-if="pagination.nextPageUrl" class="page-item">
                        <a class="page-link" @click="$emit('next');">
                            Next
                        </a>
                    </li>
                    <li v-else class="page-item disabled">
                        <a class="page-link" @click="$emit('next');">
                            Next
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        props: ['pagination', 'filtered']
    }
</script>
