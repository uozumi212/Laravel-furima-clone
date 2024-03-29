<!--<script setup>-->

<!--import StarIcon from '../../js/components/StarIcon.vue'; // ここに移動する-->
<!--import app from '../app.js';-->

<!--</script>-->
<script setup>
import axios from 'axios'; // 例としてのimport文
import {defineProps} from 'vue'; // 例としてのimport文

const props = defineProps(['productId', 'isFavorite']); // props を定義
const emit = defineEmits(['update:isFavorite']);

const toggleFavorite = async () => {
// お気に入りの状態を切り替えるロジック
    const action = props.isFavorite ? 'remove-from-favorites' : 'add-to-favorites';
    try {
        const response = await axios.post(`/${action}`, { id: props.productId });
        if (response.data.success) {
            emit('update:isFavorite', !props.isFavorite);
        }
    } catch (error) {
        console.error(`Error ${props.isFavorite ? 'removing' : 'adding'} favorite:`, error);
    }
};
</script>


<template>
<div @click="toggleFavorite">
        <!-- お気に入りアイコン -->
        <i :class="{ 'fa fa-star': isFavorite, 'fa-star-o': !isFavorite }" style="width: 20px; height: 20px;"></i>
    </div>
</template>
<!--<script>-->
<!--export default {-->
<!--        props: ['productId', 'isFavorite'],-->

<!--    methods: {-->
<!--        toggleFavorite() {-->
<!--            // お気に入りの状態を切り替えるロジック-->
<!--            if (this.isFavorite) {-->
<!--                // お気に入りを削除する非同期リクエストを送信-->
<!--                // axios.post('/remove-from-favorites', { productId: this.productId })-->
<!--                axios.post('/remove-from-favorites', { id: this.productId })-->
<!--                    .then(response => {-->
<!--                        if (response.data.success) {-->
<!--                            this.isFavorite = false;-->
<!--                        }-->
<!--                    })-->
<!--                    .catch(error => {-->
<!--                        console.error('Error removing favorite:', error);-->
<!--                    });-->
<!--            } else {-->
<!--                // お気に入りを追加する非同期リクエストを送信-->
<!--                // axios.post('/add-to-favorites', { productId: this.productId })-->
<!--                axios.post('/add-to-favorites', { id: this.productId })-->
<!--                    .then(response => {-->
<!--                        if (response.data.success) {-->
<!--                            this.isFavorite = true;-->
<!--                        }-->
<!--                    })-->
<!--                    .catch(error => {-->
<!--                        console.error('Error adding favorite:', error);-->
<!--                    });-->
<!--            }-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

<!--<script>-->
<!--export default {-->
<!--    props: ['productId', 'isFavorite'],-->

<!--    methods: {-->
<!--        toggleFavorite() {-->
<!--            // お気に入りの状態を切り替える非同期処理-->
<!--            if (this.isFavorite) {-->
<!--                axios.post(`/remove-from-favorites/${this.productId}`)-->
<!--                    .then(response => {-->
<!--                        if (response.data.success) {-->
<!--                            this.isFavorite = false;-->
<!--                        }-->
<!--                    })-->
<!--                    .catch(error => {-->
<!--                        console.error('Error removing favorite:', error);-->
<!--                    });-->
<!--            } else {-->
<!--                axios.post(`/add-to-favorites/${this.productId}`)-->
<!--                    .then(response => {-->
<!--                        if (response.data.success) {-->
<!--                            this.isFavorite = true;-->
<!--                        }-->
<!--                    })-->
<!--                    .catch(error => {-->
<!--                        console.error('Error adding favorite:', error);-->
<!--                    });-->
<!--            }-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

<style scoped>
.star-icon {
    width: 20px;
    height: 20px;
    cursor: pointer;
}
</style>
