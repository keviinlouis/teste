<template>
    <v-card>
        <v-container style="min-height: 300px;">
            <v-layout row wrap>
                <v-flex xs9 mb-3>
                    <div class="headline font-weight-bold ">
                        {{!employeeId
                        ? $t('page.employee.title_new')
                        : $t('page.employee.title_edit')}}
                    </div>
                </v-flex>
                <v-flex xs12 mb-3>
                    <v-divider></v-divider>
                </v-flex>
                <v-flex xs12>
                    <v-form data-vv-scope="employee" @submit.prevent="save">
                        <v-layout row wrap>
                            <v-flex md5 mr-3>
                                <v-text-field id="name"
                                              name="name"
                                              :label="$t('label.name')"
                                              v-model="form.name"
                                              v-validate="'required|min:3'"
                                              :disabled="!form.is_owner"
                                              :error-messages="errors.first('employee.name')"
                                              @keyup.enter="save"
                                >
                                </v-text-field>
                            </v-flex>
                        </v-layout>

                        <v-btn color="error"
                               :to="{name: 'employees'}"
                               outline>
                            {{$t('btn.cancel')}}
                        </v-btn>
                        <v-btn color="primary"
                               @click="save"
                               :loading="loading"
                               :disabled="loading || !form.is_owner">
                            {{$t('btn.save')}}
                        </v-btn>
                    </v-form>

                </v-flex>
            </v-layout>
        </v-container>
    </v-card>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        name: 'Employee',
        computed: {
            ...mapGetters({
                employee: 'employees/getEmployee',
            }),
        },
        data() {
            return {
                loading: false,
                employeeId: 0,
                form: {
                    name: '',
                    is_owner: true
                },
            };
        },
        created() {
            this.employeeId = this.$router.currentRoute.params.id;

            if (!!this.employeeId) {
                this.loadEmployee();
            }
        },
        beforeDestroy() {
            this.employeeId = 0;
            this.form = {
                name: '',
                is_owner: true
            };
        },
        methods: {
            async loadEmployee() {
                this.loading = true;
                let response = await this.$store.dispatch('employees/loadEmployee', this.employeeId);
                this.loading = false;

                if (response.isFailed()) {
                    return this.$store.dispatch('setToast', {text: response.getMessage()});
                }

                this.form = {...this.employee};
            },
            async save() {
                let response;
                this.loading = true;

                let form = {...this.form};

                if (!!this.employeeId) {

                    response = await this.$store.dispatch('employees/editEmployee', form);
                } else {
                    response = await this.$store.dispatch('employees/createEmployee', form);
                }

                this.loading = false;

                this.handleResponse(response, 'employee', () => {
                    this.$router.push({name: 'employees'});
                    this.$store.dispatch('setToast', {text: this.$t('page.employees.employee_added_success')});
                });

                if (response.isFailed()) {
                    this.$store.dispatch('setToast', {text: response.getMessage()});
                }
            },
        },
    };
</script>

<style scoped>
    .btn-full.v-btn {
        width: 100%;
        padding: 0;
    }

    .tipo {
        font-family: Montserrat, Roboto, sans-serif;
        font-size: 15px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        color: #4a4a4a;
    }

</style>
