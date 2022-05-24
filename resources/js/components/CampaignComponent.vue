<template>
        <div>
            <div>
                <button type="button" class="add-button" @click="addCampaign()">
                    Add campaign
                </button>
            </div>
            <div class="filter-sort-buttons" v-show="this.campaigns.length > 0 || this.filteredArray === true">
                Filter Campaigns by status:
                <select v-model="filteredStatus" @change="filterCampaignsByStatus()">
                    <option value="null"></option>
                    <option :value="key" v-for="(value, key) in statuses">{{value}}</option>
                </select>
            </div>
            <div v-show="this.campaigns.length > 0 || this.filteredArray === true">
                Sort Campaigns by start date:
                <select v-model="sortType" @change="sortCampaignsByStartDate()">
                    <option value="asc">ascending</option>
                    <option value="desc">descending</option>
                </select>
            </div>

            <table v-show="this.campaigns.length > 0" class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Start date</th>
                    <th></th>
                    <th></th>
                    <th>Creatives</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(campaign, i) in this.campaigns" :key="campaign.id">
                    {{campaign}}
                    <td>
                        <input type="text" v-model="campaign.title" name="campaign_name">
                        <span class="helper-text" data-error="Title is required"></span>
                    </td>
                    <td>
                        <select v-model="campaign.status" @change="onCampaignStatusChange(campaign)">
                            <option  :value="key" v-for="(value, key) in this.statuses">{{value}}</option>
                        </select>
                    </td>
                    <td>{{ new Date(campaign.start_date).toLocaleDateString() }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="remove-button" @click="removeCampaign(i)">Remove campaign</button>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="add-button" @click="addCreative(campaign)">Add creative</button>
                        </div>
                    </td>
                    <td class="creatives-block">
                        <creative-component :campaign="campaign"></creative-component>
                    </td>
                </tr>
                <hr>
                </tbody>
            </table>
            <button v-show="this.campaigns.length > 0" type="button" class="save-button" @click="saveCampaigns()">
                Save campaigns
            </button>

            {{ this.info }}

        </div>
</template>

<script>
    import moment from 'moment';
    import Vuelidate from 'vuelidate';
    import required from 'vuelidate/lib/validators/required';
    import CreativeComponent from "../components/CreativeComponent";
    export default {
        components: {
            CreativeComponent
        },
        data() {
            return {
                timestamp: '',
                dbCampaigns: [],
                campaigns: [],
                tempRecipes: [],
                info: '',
                statuses: {
                    0: 'Draft',
                    1: 'Live',
                    2: 'Finished'
                },
                filteredStatus: null,
                sortType: '',
                filteredArray: false
            }
        },

        created() {
            this.loadCampaigns();
            setInterval(this.getNow, 1000);
        },
        computed: {

        },

        methods: {

            loadCampaigns() {
                this.axios
                    .get('/api/campaigns')
                    .then(response => {
                        this.dbCampaigns = this.campaigns = response.data;
                    })
            },

            addCampaign(){
                this.campaigns.push({
                    id: null,
                    title: '',
                    status: '',
                    start_date: this.timestamp,
                    creatives: []
                });
            },

            removeCampaign(i) {
                this.campaigns.splice(i, 1);
            },

            addCreative(campaign, i){
                campaign.creatives.push({
                    id: null,
                    title: '',
                    status: '',
                    campaign_id: campaign['id']
                });
            },

            filterCampaignsByStatus()
            {
                this.filteredArray = true;
                let tempCampaigns = this.dbCampaigns;
                if (this.filteredStatus !== "null") {
                    this.campaigns = tempCampaigns.filter((item) => item.status === parseInt(this.filteredStatus));
                    console.log(tempCampaigns);
                } else {
                    this.campaigns = this.dbCampaigns;
                }
                return this.campaigns;
            },

            sortCampaignsByStartDate () {
                console.log(this.sortType);
                let tempCampaigns = this.dbCampaigns;

                // const order = this.sortType == 'asc' ? 1 : -1;
                // // `this` points to the vm instance
                // this.campaigns = tempCampaigns.sort(campaign => {
                //     return new moment(campaign.start_date)
                // a = new Date(a.date);
                // b = new Date(b.date);
                // const results = a > b ? -1 : a < b ? 1 : 0;
                // return results * order;
                // });
                //
                // if (this.sortType === 'desc') {
                //     this.campaigns.reverse();
                // }

                this.campaigns = _.orderBy(tempCampaigns, (campaign) => {
                    return moment(campaign.start_date)
                }, [this.sortType]);
                console.log(this.campaigns);

                return this.campaigns;

            },

            // getFormattedDate(date) {
            //     return moment(date).format("DD.MM.YYYY")
            // },

            getNow () {
                const today = new Date();
                const date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                this.timestamp = date + ' ' + time;
            },

            saveCampaigns () {
                const url = '/api/campaigns';
                const campaigns = this.campaigns;
                this.axios
                    .post(url, {campaigns})
                    .then(response => {
                        console.log(response.data);
                        debugger
                        if (response.data === "ok") {
                            window.location.reload();
                            this.info = 'Data saved successfully!';
                        } else {
                            this.info = response.data;

                        }
                    })
            },

            onCampaignStatusChange (campaign) {
                campaign.creatives.forEach((creative) => {
                    creative.status = campaign.status
                })
            }

        }
    }
</script>