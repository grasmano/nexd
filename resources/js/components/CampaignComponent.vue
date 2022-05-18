<template>
    <fragment>
        <div>
            <button type="button" class="add-campaign-btn" @click="addCampaign()">
                + Add campaign
            </button>
            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Start date</th>
                    <th></th>
                    <th></th>
                    <!-- <th>Actions</th> -->
                </tr>
                </thead>
                <tbody>
                <tr v-for="(campaign, i) in campaigns" :key="campaign.id">
                    <td>
                        <input type="text" v-model="campaigns[i].title">
                    </td>
                    <td>
                        <select v-model="campaigns[i].status">
                            <!--<option :value="status" v-for="{key,value} in campaignStatuses">{{name}}</option>-->
                            <option  :value="key" v-for="(value, key) in statuses">{{value}}</option>
                        </select>
                    </td>
                    <td>{{ getFormattedDate(campaigns[i].start_date) }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <!--<router-link :to="{name: 'edit', params: { id: campaign.id }}" class="btn btn-success">Edit</router-link>-->
                            <button class="delete-campaign-btn" @click="deleteCampaign(i)">- Delete Campaign</button>
                        </div>
                    </td>
                    <td>
                        <div>
                            <button class="add-creative-btn" @click="addCreative()">+ Add creative</button>
                            <table>
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(creative, k) in campaign.creatives" :key="creative.id">
                                    <td>
                                        <input type="text" v-model="creative[k].title">
                                    </td>
                                    <td>
                                        <select v-model="creative[k].status">
                                            <!--<option :value="status" v-for="{key,value} in campaignStatuses">{{name}}</option>-->
                                            <option  :value="key" v-for="(value, key) in statuses">{{value}}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="delete-creative-btn" @click="deleteCreative(i, k)">- Delete Creative</button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!--<creative-component></creative-component>-->
                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
            {{ campaigns }}
            <button type="button" class="save-campaigns-btn" @click="addCampaign()">
                Save campaigns
            </button>
        </div>
    </fragment>
</template>

<script>
    import moment from 'moment';
    import fragment from 'vue-fragment';
    export default {
        data() {
            return {
                timestamp: "",
                creatives: [],
                campaigns: [],
                statuses: {
                    0: 'Draft',
                    1: 'Live',
                    2: 'Finished'
                }
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/campaigns/')
                .then(response => {
                this.campaigns = response.data;
            });
            this.axios
                .get('http://localhost:8000/api/creatives/')
                .then(response => {
                    this.campaigns[i].creatives = response.data;
            });
            setInterval(this.getNow, 1000);
        },
        methods: {
            addCampaign(){
                this.campaigns.push({
                    id: null,
                    title: 'New campaign title',
                    status: '0',
                    start_date: this.timestamp,
                    creatives: []
                });
            },

            deleteCampaign(i) {
                this.campaigns.splice(i, 1);
            },

            addCreative(i){
                this.campaigns[i].creatives.push({
                    title: 'New creative title',
                    status: '0',
                    campaign_id: i
                });
            },

            deleteCreative(i, k) {
                this.campaigns[i].creatives[k].splice(i, 1);
            },

            getFormattedDate(date) {
                return moment(date).format("DD.MM.YYYY")
            },

            getNow: function() {
                const today = new Date();
                const date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                this.timestamp = date + ' ' + time;
            }
            // deleteProduct(id) {
            //     this.axios
            //         .delete(`http://localhost:8000/api/products/${id}`)
            //         .then(response => {
            //         let i = this.products.map(data => data.id).indexOf(id);
            //     this.products.splice(i, 1)
            // });
            // }
        }
    }
</script>