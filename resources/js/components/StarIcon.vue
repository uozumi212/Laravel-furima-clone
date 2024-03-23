

<template>
    <div @click="toggleFavorite">
        <!-- お気に入りアイコン -->
        <i :class="{ 'fa fa-star': isFavorite, 'fa-star-o': !isFavorite }" style="width: 20px; height: 20px;"></i>
    </div>
</template>
<script>
export default {
        props: ['productId', 'isFavorite'],

    methods: {
        toggleFavorite() {
            // お気に入りの状態を切り替えるロジック
            if (this.isFavorite) {
                // お気に入りを削除する非同期リクエストを送信
                // axios.post('/remove-from-favorites', { productId: this.productId })
                axios.post('/remove-from-favorites', { id: this.productId })
                    .then(response => {
                        if (response.data.success) {
                            this.isFavorite = false;
                        }
                    })
                    .catch(error => {
                        console.error('Error removing favorite:', error);
                    });
            } else {
                // お気に入りを追加する非同期リクエストを送信
                // axios.post('/add-to-favorites', { productId: this.productId })
                axios.post('/add-to-favorites', { id: this.productId })
                    .then(response => {
                        if (response.data.success) {
                            this.isFavorite = true;
                        }
                    })
                    .catch(error => {
                        console.error('Error adding favorite:', error);
                    });
            }
        }
    }
}
</script>

<style>
/* 必要に応じてスタイルを追加 */
</style>
