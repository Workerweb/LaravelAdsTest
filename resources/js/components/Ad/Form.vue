<template>
    <div class="container">
        <div class="row justify-content-center">
            <a-form :form="form" :label-col="{ span: 5 }" :wrapper-col="{ span: 12 }" @submit="handleSubmit" style="padding: 10px;">
              <a-form-item label="Название">
                <a-input
                  v-decorator="['name', {initialValue: ad.name, rules: [{ required: true, message: 'Обязательное поле!' }] }]"
                  @change="handleNameChange"
                />
              </a-form-item>
              <a-form-item label="Описание">
                <a-input
                  v-decorator="['description', { rules: [{ required: true, message: 'Обязательное поле!' }] }]"
                  @change="handleDescriptionChange"
                />
              </a-form-item>
              <a-form-item label="Цена">
                <price-input
                  v-decorator="[
                    'price',
                    {
                      initialValue: ad.price,
                      rules: [{ validator: checkPrice }],
                    },
                  ]"
                  @change="handlePriceChange"
                />
              </a-form-item>
              <a-form-item label="Ссылки на фото">
                <template v-for="(photo, index) in ad.photos">
                  <a-input v-model="photo.url" :key="index"/>
                </template>
                <a-button v-if="ad.photos.length < 3" type="primary" @click.prevent="addLink">
                  Добавить фото
                </a-button>
              </a-form-item>
              <a-form-item :wrapper-col="{ span: 12, offset: 5 }">
                <a-button type="primary" html-type="submit">
                  Создать
                </a-button>
              </a-form-item>
            </a-form>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    const PriceInput = {
      props: ['value'],
      template: `
        <span>
          <a-input
            type='text'
            :value="number"
            @change="handleNumberChange"
            style="width: 63%; margin-right: 2%;"
          />
        </span>
      `,
      data() {
        const value = this.value || 0;
        return {
          number: value || 0,
        };
      },
      watch: {
        value(val = {}) {
          this.number = val || 0;
        },
      },
      methods: {
        handleNumberChange(e) {
          const number = parseInt(e.target.value || 0, 10);
          if (isNaN(number)) {
            return;
          }
          this.triggerChange(number);
        },
        triggerChange(changedValue) {
          // Should provide an event to pass value to Form.
          this.$emit('change', changedValue);
        },
      },
    };
    
    export default {
      components: {
        PriceInput,
      },
      data() {
        return {
          formLayout: 'horizontal',
          form: this.$form.createForm(this, { name: 'coordinated' }),
          ad: {
            photos: []
          }
        };
      },
      methods: {
        handleSubmit(e) {
          e.preventDefault();
          this.form.validateFields((err, values) => {
            if (!err) {
              this.$store.dispatch('storeAd_action', this.ad)
            }
          });
        },
        checkPrice(rule, value, callback) {
          if (value > 0) {
            callback();
            return;
          }
          callback('Цена должна быть больше нуля!');
        },
        addLink() {
          this.ad.photos.push({ url: '' });
        },
        handleNameChange(e) {
          this.ad.name = e.target.value
        },
        handleDescriptionChange(e) {
          this.ad.description = e.target.value
        },
        handlePriceChange(value) {
          this.ad.price = value
        }
      },
    };
</script>