<template>
    <div>
    <router-view/>
    <snack-bar></snack-bar>
    </div>
</template>

<script>

import SnackBar from '@/components/SnackBar';

export default {
  name: 'App',
  components: { SnackBar },
};
</script>

<style>
    .v-date-picker-table .v-btn.v-btn--active {
        color: #d14444 !important;
    }
    .bar {
        background-color: #d14444 !important;
        border-color: #d14444 !important;
    }

    .spinner {
        display: none !important;
    }
</style>
