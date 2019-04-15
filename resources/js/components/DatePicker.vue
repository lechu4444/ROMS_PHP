<template>
    <div class="form-group row">
        <input type="hidden" :name=fieldName v-model=value />
        <label :for="fieldName + '-year'" class="col-sm-2 form-control-label">{{label}}</label>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-4">
                    <input
                        :id="fieldName + '-year'"
                        type="number"
                        :max=maxYear
                        min="1900"
                        :name="fieldName + '-year'"
                        class="form-control"
                        v-model="selectedYear"
                        @change="updateMaxDayAndValue"
                    />
                </div>
                <div class="col-sm-6">
                    <select
                            class="form-control"
                            :name="fieldName + '-month'"
                            :id="fieldName"
                            v-model="selectedMonth"
                            @change="updateMaxDayAndValue"
                    >
                        <option v-for="month in months" :value="month.value">
                            {{ month.name }}
                        </option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <input
                            :id="fieldName + '-day'"
                            type="number"
                            v-bind:max="maxDay"
                            min="1"
                            :name="fieldName + '-day'"
                            class="form-control"
                            v-model="selectedDay"
                            @change="updateValue"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['label', 'fieldName', 'value', 'maxYear'],
        created() {
            console.log('hi');
        },
        data() {
            if (this.value === '') {
                this.value = '2000-01-01'
            }

            let dateArray = this.value.split('-');
            let selectedYear = dateArray[0];
            let selectedMonth = dateArray[1];
            let selectedDay = dateArray[2];
            let months = [
                {
                    'name': 'Styczeń',
                    'value': '01',
                    'daysAmount': 31
                },
                {
                    'name': 'Luty',
                    'value': '02',
                    'daysAmount': 28
                },
                {
                    'name': 'Marzec',
                    'value': '03',
                    'daysAmount': 31
                },
                {
                    'name': 'Kwiecień',
                    'value': '04',
                    'daysAmount': 30
                },
                {
                    'name': 'Maj',
                    'value': '05',
                    'daysAmount': 31
                },
                {
                    'name': 'Czerwiec',
                    'value': '06',
                    'daysAmount': 30
                },
                {
                    'name': 'Lipiec',
                    'value': '07',
                    'daysAmount': 31
                },
                {
                    'name': 'Sierpień',
                    'value': '08',
                    'daysAmount': 31
                },
                {
                    'name': 'Wrzesień',
                    'value': '09',
                    'daysAmount': 30
                },
                {
                    'name': 'Październik',
                    'value': '10',
                    'daysAmount': 31
                },
                {
                    'name': 'Listopad',
                    'value': '11',
                    'daysAmount': 30
                },
                {
                    'name': 'Grudzień',
                    'value': '12',
                    'daysAmount': 31
                }
            ];

            let maxDay = months[selectedMonth - 1].daysAmount;
            console.log(maxDay);

            return {
                months: months,
                selectedYear: selectedYear,
                selectedMonth: selectedMonth,
                selectedDay: selectedDay,
                maxDay: maxDay
            }
        },
        methods: {
            updateMaxDay: function () {
                this.maxDay = this.months[this.selectedMonth - 1].daysAmount;

                if (this.selectedMonth === '02' && this.selectedYear % 4 === 0) {
                    this.maxDay = 29
                }

                if (this.selectedDay > this.maxDay) {
                    this.selectedDay = this.maxDay;
                }
            },
            updateValue: function () {
                this.value = this.selectedYear + '-' + this.selectedMonth + '-' + this.addZero(this.selectedDay);
            },
            updateMaxDayAndValue: function () {
                this.updateMaxDay();
                this.updateValue();
            },
            addZero: function (number) {
                if (number < 10) {
                    return '0' + number;
                } else {
                    return number;
                }
            }
        }
    }
</script>
