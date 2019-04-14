<template>
    <div class="form-group row">
        <input type="hidden" :name=fieldName value="" />
        <label :for="fieldName + '-year'" class="col-sm-2 form-control-label">{{label}}</label>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-4">
                    <input
                        :id="fieldName + '-year'"
                        type="number"
                        maxlength="4"
                        minlength="4"
                        :name="fieldName + '-year'"
                        class="form-control"
                    />
                </div>
                <div class="col-sm-6">
                    <select :name="fieldName + '-month'" :id="fieldName + '-month'">
                        <opiton :v-for="month in this.months" :value="1">
                            {{month['name']}}
                        </opiton>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['label', 'fieldName'],
        months: [
            {
                'name': 'Styczeń',
                'value': 1,
                'daysAmount': 31
            },
            {
                'name': 'Luty',
                'value': 2,
                'daysAmount': 29
            },
            {
                'name': 'Marzec',
                'value': 3,
                'daysAmount': 31
            },
            {
                'name': 'Kwiecień',
                'value': 4,
                'daysAmount': 30
            },
            {
                'name': 'Maj',
                'value': 5,
                'daysAmount': 31
            },
            {
                'name': 'Czerwiec',
                'value': 6,
                'daysAmount': 30
            },
            {
                'name': 'Lipiec',
                'value': 7,
                'daysAmount': 31
            },
            {
                'name': 'Sierpień',
                'value': 8,
                'daysAmount': 31
            },
            {
                'name': 'Wrzesień',
                'value': 9,
                'daysAmount': 30
            },
            {
                'name': 'Październik',
                'value': 10,
                'daysAmount': 31
            },
            {
                'name': 'Listopad',
                'value': 11,
                'daysAmount': 30
            },
            {
                'name': 'Grudzień',
                'value': 12,
                'daysAmount': 31
            }
        ]
    }
</script>
