<template>
    <div class="card">
        <span class="green white-text badge">{{ message.type }}</span>

        <div class="card-content">
            <blockquote>
                <strong>Mensagem:</strong> {{ message.message }}
            </blockquote>            
        </div>
        <div class="card-action">
            <a href="">Editar</a>
            <a href="">Remover</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'messageData'
        ],
        computed: {
            message: function () {
                return this.messageData
            }
        }
    }
</script>