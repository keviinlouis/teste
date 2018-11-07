<template>
    <v-card>
        <v-container
                fluid
                style="min-height: 300px;"
                grid-list-lg>
            <v-layout column align-center>
                <img src="@/assets/logo.png" alt="Polvo" class="mb-5">
                <blockquote>
                    &#8220;{{$t('text.resource_not_founded')}}&#8221;
                    <footer>
                        <small>
                            <em>&mdash;{{$t('text.equipe_polvo')}}</em>
                        </small>
                    </footer>
                </blockquote>
            </v-layout>
        </v-container>
    </v-card>
</template>

<script>
export default {
  name: 'RecursoNaoDisponivel',
};
</script>

<style scoped>

</style>
