<template>
    <div>
        <table  v-show="campaign.creatives.length > 0">
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
                    <input type="text" v-model="creative.title">
                </td>
                <td>
                    <select v-model="creative.status" @change="onCreativeStatusChange(campaign)">
                        <!--<option :value="status" v-for="{key,value} in campaignStatuses">{{name}}</option>-->
                        <option  :value="key" v-for="(value, key) in statuses">{{value}}</option>
                    </select>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <button class="remove-button" @click="removeCreative(campaign, k )">Remove Creative</button>
                    </div>
                </td>{{creative}}
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
          campaign: {
              type: Object
          }
        },
        data() {
            return {
                creatives: [],
                statuses: {
                    0: 'Draft',
                    1: 'Live',
                    2: 'Finished'
                }
            }
        },
        created() {

        },
        methods: {

            removeCreative(campaign, k) {
                campaign.creatives.splice(k, 1);
            },

            onCreativeStatusChange (campaign) {
                const statuses = [];
                campaign.creatives.forEach((creative) => {
                    statuses.push(creative.status);
                });
                if (statuses.some(e => e === '1')) {
                    campaign.status = '1';
                } else {
                    if (statuses.every(e => e === '0')) {
                        campaign.status = '0';
                    }
                    if (statuses.every(e => e === '2')) {
                        campaign.status = '2';
                    }
                }
            }

        }
    }
</script>