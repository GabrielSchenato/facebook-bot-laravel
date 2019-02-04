<template>
    <div>

        <h3>Sugestões de cursos</h3>

        <table class="bordered">
            <thead>
                <tr>
                    <th>Sugestões</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data in suggestions.data" v-bind:key="data.id">
                    <td>
                        {{ data.suggestion }}
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                suggestions: {data: []}
            }
        },
        mounted() {
            window.axios.get('suggestions').then(response => {
                this.suggestions = response.data
            })
        }
    }
</script>