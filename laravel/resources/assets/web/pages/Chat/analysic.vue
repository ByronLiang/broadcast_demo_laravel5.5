<template>
    <div class="dashboard">
        <h4>saa</h4>
        <section id="auth-button"></section>
        <section id="view-selector"></section>
        <section id="timeline"></section>
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
        this.fetchData();
    },
    methods: {
        fetchData() {
            const gapi = window.gapi;
            gapi.analytics.ready(function() {
                var CLIENT_ID = '605907794204-tlkugvrp0g57ja257md98s3umvh04ihf.apps.googleusercontent.com';
                gapi.analytics.auth.authorize({
                        container: 'auth-button',
                        clientid: CLIENT_ID,
                });

                var viewSelector = new gapi.analytics.ViewSelector({
                        container: 'view-selector'
                });

                var timeline = new gapi.analytics.googleCharts.DataChart({
                    reportType: 'ga',
                    query: {
                        'dimensions': 'ga:date',
                        'metrics': 'ga:sessions',
                        'start-date': '30daysAgo',
                        'end-date': 'yesterday',
                    },
                    chart: {
                        type: 'LINE',
                        container: 'timeline'
                    }
                });
                gapi.analytics.auth.on('success', function(response) {
                    viewSelector.execute();
                });
                viewSelector.on('change', function(ids) {
                    var newIds = {
                        query: {
                            ids: ids
                        }
                    }
                    timeline.set(newIds).execute();
                });
            });
        },
    },
};
</script>