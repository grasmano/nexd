<template>
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
        <tr v-for="(creative) in creatives" :key="creative.id">
            <td>
                <input type="text" v-model="creative.title">
            </td>
            <td>
                <select v-model="creative.status">
                    <!--<option :value="status" v-for="{key,value} in campaignStatuses">{{name}}</option>-->
                    <option  :value="key" v-for="(value, key) in statuses">{{value}}</option>
                </select>
            </td>
            <td>
                <div class="btn-group" role="group">
                    <button class="delete-creative-btn" @click="deleteCreative(i)">- Delete Creative</button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
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
            this.axios
                .get('http://localhost:8000/api/creatives/')
                .then(response => {
                    this.creatives = response.data;
                });
        },
        methods: {
            addCreative(){
                this.creatives.push({
                    title: 'New creative title',
                    status: '0'
                });
            },

            deleteCreative(i) {
                this.creatives.splice(i, 1);
            }
        }
    }
</script>