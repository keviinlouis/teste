<template>
    <v-snackbar
            v-model="toast.show"
            :bottom="toast.bottom"
            :left="toast.left"
            :right="toast.right"
            :timeout="toast.timeout"
            :top="toast.top"
            auto-height
    >
        <span class="text-snack">{{ toast.text }}</span>
        <v-btn
                color="red"
                flat
                @click="closeToast"
        >
            <span class="text-snack">{{$t('label.close')}}</span>
        </v-btn>
    </v-snackbar>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'SnackBar',
  computed: {
    ...mapGetters({
      toast: 'getToast',
    }),
  },
  methods: {
    ...mapActions({
      closeToast: 'closeToast',
    }),
  },
};
</script>

<style scoped>
 .text-snack{
     font-family: 'Roboto', sans-serif;
 }
</style>
