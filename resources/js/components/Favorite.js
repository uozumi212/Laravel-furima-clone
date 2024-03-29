

async function addLike(productId) {
    try {
        const response = await axios.post(`/product/{id}/add_to_favorites`);
        console.log(response.data); // サーバーからのレスポンスをログに出力
        // 必要に応じて、UIを更新するなどの処理を実行
    } catch (error) {
        console.error('Error adding like:', error);
    }
}

// いいねを削除する関数
async function removeLike(productId) {
    try {
        const response = await axios.delete(`/product/{id}/remove-from-favorites`);
        console.log(response.data); // サーバーからのレスポンスをログに出力
        // 必要に応じて、UIを更新するなどの処理を実行
    } catch (error) {
        console.error('Error removing like:', error);
    }
}
