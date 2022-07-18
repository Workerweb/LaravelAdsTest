
const state = {
    ads: [],
    ad: {}
};

const getters = {
    ADS: state => {
        return state.ads
    },
    AD: state => {
        return state.ad
    }
};

const mutations = {
    fetchAdsList (state, data) {
        state.ads = data
    },
    fetchAd (state, data) {
        state.ad = data
    }
};
const actions = {
    fetchAdsList_action: async (context, sort = {}) => {
        let queryString
        if (Object.keys(sort).length > 0) {
            queryString = Object.keys(sort).map(key => key + '=' + sort[key]).join('&');
        }
        let {data} = await axios.get(`/api/ad${queryString ? '?' + queryString : ''}`)
        console.log(data.data.data)
            context.commit('fetchAdsList', data.data.data)
    },
    fetchAd_action: async (context, {id, fields}) => {
        let {data} = await axios.get(`/api/ad/${id}${fields ? '?fields=true' : ''}`)
            context.commit('fetchAd', data.data)
    },
    storeAd_action: async (context, ad) => {
        let {data} = await axios.post('/api/ad', ad)
        alert(`id объявления = ${data.data.id}`)
    }
};

export default {
    state,
    getters,
    mutations,
    actions,
}
