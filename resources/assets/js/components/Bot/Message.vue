<template>
    <div class="card">
        <span class="green white-text badge">{{ message.type }}</span>

        <div class="card-content">
            <blockquote>
                <strong>Mensagem:</strong> {{ message.message }}
            </blockquote>     
            
            <img :src="message.message" v-if="message.type === 'image'" class="responsive-img">
            
            <audio controls="" v-if="message.type === 'audio'">
                <source :src="message.message">
            </audio>
            
            <div v-if="message.type === 'video'" class="video-container">
                <video controls="" style="max-width: 100%">
                    <source :src="message.message">
                </video>
            </div>
            
            <blockquote v-if="message.type === 'file'">
                <a :href="message.message"><i class="material-icons">attach_file</i> Arquivo para download</a>
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