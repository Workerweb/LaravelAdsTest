<template>
    <div class="container">
        <div class="row justify-content-center">

            <div style="display: flex; justify-content: space-between;align-items: center;padding: 10px;">
                <div>
                    <a @click="sortBy('price', 'asc')" v-if="sort.column == 'price' && sort.direction == 'desc'">Сортировать по цене<i>&#8593;</i></a>
                    <a @click="sortBy('price', 'desc')" v-else>Сортировать по цене<i>&#8595;</i></a>
                    <a @click="sortBy('created_at', 'asc')" v-if="sort.column == 'created_at' && sort.direction == 'desc'">Сортировать по дате<i>&#8593;</i></a>
                    <a @click="sortBy('created_at', 'desc')" v-else>Сортировать по дате<i>&#8595;</i></a>
                </div>
                <a href="/ad/create">Создать объявление</a>
            </div>

            <a-list item-layout="vertical" :data-source="ADS" :pagination="pagination">
                <a-list-item slot="renderItem" slot-scope="item, index">
                    <a-list-item-meta
                    :description="`${item.description}`"
                    >
                        <a slot="title" :href="`/ad/${item.id}`">{{ item.name}} Цена: {{item.price}}</a>
                        <a-avatar
                        slot="avatar"
                        v-if="item.main_photo_url"
                        :src="item.main_photo_url"
                        />
                    </a-list-item-meta>
                </a-list-item>
            </a-list>

        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        data() {
            return {
              pagination: {
                onChange: page => {
                  console.log(page);
                },
                pageSize: 10,
              },
              sort: {
                column: '',
                direction: ''
              }
            };
        },
        mounted() {
            this.$store.dispatch('fetchAdsList_action')
        },
        computed: {
            ...mapGetters(['ADS'])
        },
        methods: {
            sortBy(column, direction) {
                this.sort.column = column
                this.sort.direction = direction
                this.$store.dispatch('fetchAdsList_action', this.sort)
            }
        }
    }
</script>
