<template>
    <div class="dashboard">
    <h2>{{ author.name }} 的 Chat Room</h2>
        <div>在线人数：<span>{{ usersInRoom.length }}</span></div>
        <div class="chat-log" style="500px; overflow: auto">
            <div class="chat-message" v-for="message in messages"
                :key="message.id">
                <p>{{ message.message }}</p>
                <small>{{ message.user.name }}</small>
            </div>
            <div class="empty" v-show="messages.length === 0">
                Nothing here yet!
            </div>
        </div>
        <div class="chat-composer" style="margin-top: 50px;">
            <el-input placeholder="Start typing your message..." 
                v-model="messageText" @keyup.enter="sendMessage">
                    <el-button slot="append" icon="el-icon-message" 
                        @click="sendMessage">Send</el-button>
                </el-input>
        </div>
        <div>
            <el-button type="normal" @click="sendFinishedOrder">Buy it</el-button>
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
        // this.initPurchaseListen();
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
        sendNotifation(user, type) {
            if (type == 'leave') {
                $ele.$notify({
                    title: '消息',
                    message: user.name + '离开了聊天室',
                    duration: 0
                });
            } else if (type == 'join') {
                $ele.$notify({
                    title: '消息',
                    message: user.name + '加入了聊天室',
                    duration: 0
                });
            }
        },
        initEcho() {
            Echo.join('chatroom' + this.$route.params.id)
                .here((users) => {
                    console.log(users);
                    this.usersInRoom = users;
                })
                .joining((user) => {
                    console.log(user);
                    this.sendNotifation(user, 'join');
                    this.usersInRoom.push(user);
                })
                .leaving((user) => {
                    this.usersInRoom = this.usersInRoom.filter(u => u != user)
                    this.sendNotifation(user, 'leave');
                })
                .listen('MessagePosted', (e) => {
                    console.log(e.message.message);
                    this.messages.push({
                        message: e.message.message,
                        user: e.user
                    });
                })
                .listen('FinishedPurchase', (e) => {
                    console.log(e);
                    // this.messages.push({
                    //     message: e.message.message,
                    //     user: e.user
                    // });
                });
        },
        initPurchaseListen() {
            Echo.join('chatroom' + this.$route.params.id)
                .listen('FinishedPurchase', (e) => {
                    console.log(e);
                    // this.messages.push({
                    //     message: e.message.message,
                    //     user: e.user
                    // });
                });
        },
        sendFinishedOrder() {
            API.get('pay_order?author=' + this.$route.params.id).then((r) => {
                console.log('aa');
            });
        },
        sendMessage() {
            API.post('/message', {
                message: this.messageText,
                author: this.$route.params.id
            })
            .then((r) => {
                this.messageText = '';
            });
        },
    },
};
</script>

<style lang="css">
.dashboard {
    width: 80%;
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