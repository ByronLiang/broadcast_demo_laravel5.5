<template>
    <div class="dashboard">
    <h2>{{ author.name }} 的 Chat Room</h2>
        <div>在线人数：<span>{{ usersInRoom.length }}</span></div>
        <div class="chat-log">
            <div class="chat-message" v-for="message in messages"
                :key="message.id">
                <p>{{ message.message }}</p>
                <small>{{ message.user.name }}</small>
            </div>
            <div class="empty" v-show="messages.length === 0">
                Nothing here yet!
            </div>
        </div>
        <div class="chat-composer">
            <el-input placeholder="Start typing your message..." 
                v-model="messageText" @keyup.enter="sendMessage"></el-input>
            <el-button class="btn btn-primary" 
                @click="sendMessage">Send</el-button>
        </div>
    </div>
</template>

<script>
import {Button, Input} from 'element-ui';

export default {
    components: {
        ElInput: Input,
        ElButton: Button,
    },
    data() {
        return {
            author: [],
            messages: [],
            messageText: '',
            usersInRoom: [],
        };
    },
    created() {
        this.fetchData();
        this.initEcho();
    },
    mounted() {
    },
    methods: {
        fetchData() {
            if (this.$route.params.id) {
                API.get('chat_info', {
                    params: {
                        id: this.$route.params.id
                    }
                })
                .then((r) => {
                    this.author = r;
                    this.messages = r.messages;
                });
            }
        },
        initEcho() {
            Echo.join('chatroom')
                .here((users) => {
                    console.log(users);
                    this.usersInRoom = users;
                })
                .joining((user) => {
                    console.log(user);
                    this.usersInRoom.push(user);
                })
                .leaving((user) => {
                    this.usersInRoom = this.usersInRoom.filter(u => u != user)
                })
                .listen('MessagePosted', (e) => {
                    this.messages.push({
                        message: e.message.message,
                        user: e.user
                    });
                });
        },
        sendMessage() {
            API.post('/message', {
                message: this.messageText,
                author: this.$route.params.id
            })
            .then((r) => {
                this.messages.push({
                    messages: this.messageText,
                    users: r.user
                });
            });
        },
    },
};
</script>

<style lang="css">
.dashboard {
    width: 70%;
    margin: 0 auto;
}
.chat-message {
    padding: 1rem;
}

.chat-message > p {
    margin-bottom: .5rem;
}
.chat-log .chat-message:nth-child(even) {
    background-color: #ccc;
}

.empty {
    padding: 1rem;
    text-align: center;
}
</style>