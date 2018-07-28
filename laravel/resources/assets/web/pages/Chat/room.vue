<template>
    <div class="dashboard">
    <h2>Chat Room</h2>
    </div>
</template>

<script>
export default {
    components: {},
    data() {
        return {
            author: [],
        };
    },
    created() {
        this.fetchData();
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
                });
            }
        }
    },
};
</script>