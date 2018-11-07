<template>
    <v-card>
        <v-btn
                dark
                fab
                fixed
                bottom
                right
                @click="newEmployee()"
        >
            <v-icon>add</v-icon>
        </v-btn>
        <v-container style="min-height: 300px;" >

            <v-layout row wrap>

                <v-flex xs9 mb-3>
                    <div class="headline font-weight-bold ">{{$t('page.employees.title')}}</div>
                </v-flex>
                <v-flex xs12 mb-3>
                    <v-divider></v-divider>
                </v-flex>
                <v-flex xs3 pr-1>
                    <v-text-field append-icon="search"
                                  name="search"
                                  :label="$t('label.search')"
                                  v-model="query.search"
                                  type="text">
                    </v-text-field>
                </v-flex>
                <v-flex xs12>
                    <v-data-table
                            :headers="headers"
                            :items="employees"
                            :pagination.sync="pagination"
                            class="elevation-1"
                            :loading="loading"
                            :total-items="query.limit"
                            :no-data-text="$t('table.no_results')"
                            :no-results-text="$t('table.no_results')"
                            hide-actions
                    >
                        <template slot="items" slot-scope="props">
                            <td>
                                {{ props.item.name }}
                            </td>

                            <td>
                                <v-btn flat icon color="primary" @click="showEmployee(props.item)">
                                    <v-icon>{{props.item.is_owner ? 'edit' : 'remove_red_eye'}}</v-icon>
                                </v-btn>
                            </td>
                        </template>
                    </v-data-table>
                    <div class="text-xs-center pt-2">
                        <v-pagination v-model="pagination.page" :length="pages"></v-pagination>
                    </div>
                </v-flex>
            </v-layout>
        </v-container>
    </v-card>
</template>

<script>
import { mapGetters } from 'vuex';

import _ from 'lodash';

export default {
  name: 'Employees',
  computed: {
    ...mapGetters({
      employees: 'employees/getEmployees',
      employeesIdsInCart: 'cart/getEmployeesIds'
    }),
  },
  data() {
    return {
      loading: false,
      debounceSearch: _.debounce(this.sendSearch, 300),
      pages: 1,
      totalItems: 0,
      pagination: {
        descending: false,
        page: 1,
        sortBy: 'name',
      },
      query: {
        search: '',
        limit: 15,
      },
      headers: [
        {
          text: this.$t('page.employees.table.headers.name'),
          value: 'name',
        },
        {
          sortable: false,
        },
      ],
    };
  },
  methods: {
    showEmployee(employee) {
      return this.$router.push({
        name: 'edit-employee',
        params: { id: employee.id },
      });
    },
    newEmployee(){
      return this.$router.push({
        name: 'new-employee'
      })
    },
    async sendSearch() {
      const query = {
        sort: this.pagination.sortBy,
        page: this.pagination.page,
        limit: this.query.limit,
        search: this.query.search,
        order: this.pagination.descending ? 'desc' : 'asc',
      };

      this.loading = true;

      const response = await this.$store.dispatch('employees/loadEmployees', query);

      this.pages = response.getLastPage();
      this.pagination.page = response.getCurrentPage();
      this.totalItems = response.getTotalItens();
      this.loading = false;
    },


  },
  watch: {
    query: {
      handler() {
        this.debounceSearch();
      },
      deep: true,
    },
    pagination: {
      handler() {
        this.debounceSearch();
      },
      deep: true,
    },
  },
};
</script>

<style scoped>
    .btn-full.v-btn {
        width: 100%;
        padding: 0;
    }

</style>
