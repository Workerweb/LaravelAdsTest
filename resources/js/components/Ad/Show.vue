<template>
    <div class="container">
        <div class="row justify-content-center">
            <a-card hoverable style="width: 500px;">
                <img
                  slot="cover"
                  alt="example"
                   v-if="AD.main_photo_url"
                  :src="AD.main_photo_url"
                />
                <a-card-meta :title="`${AD.name} ${AD.price}`">
                  <template slot="description">
                    {{AD.description}} <br>
                    <a @click.prevent="getAdditionalInfo">Запросить дополнительную инфу</a>
                  </template>
                </a-card-meta>
            </a-card>
            <a-carousel dots-class="slick-dots slick-thumb" style="width: 500px;">
                    <a slot="customPaging" slot-scope="props">
                      <img :src="AD.photos[0].url" />
                    </a>
                    <div v-for="photo in AD.photos">
                      <img v-if="photo.url" :src="photo.url"/>
                    </div>
                </a-carousel>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    let str = window.location.pathname
    let res = str.split("/")
    // console.log(res)
    export default {
        computed: {
            ...mapGetters(['AD']),
        },
        mounted() {
            if (res[2] !== 'create') {
                this.$store.dispatch('fetchAd_action', {id:res[2], fields: false})
            }
        },
        methods: {
            getAdditionalInfo() {
                this.$store.dispatch('fetchAd_action', {id:res[2], fields: true})
            },
        }
    }
</script>
<style scoped>
/* For demo */
.ant-carousel >>> .slick-dots {
  height: auto;
}
.ant-carousel >>> .slick-slide img {
  border: 5px solid #fff;
  display: block;
  margin: auto;
  max-width: 80%;
}
.ant-carousel >>> .slick-thumb {
  bottom: -45px;
}
.ant-carousel >>> .slick-thumb li {
  width: 60px;
  height: 45px;
}
.ant-carousel >>> .slick-thumb li img {
  width: 100%;
  height: 100%;
  filter: grayscale(100%);
}
.ant-carousel >>> .slick-thumb li.slick-active img {
  filter: grayscale(0%);
}
</style>