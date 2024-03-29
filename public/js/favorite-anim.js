
var animateButton = function(e) {

    e.preventDefault();
    //reset animation
    e.target.classList.remove('animate');

    e.target.classList.add('animate');
    setTimeout(function(){
        e.target.classList.remove('animate');
    },700);
};

var bubblyButtons = document.getElementsByClassName("bubbly-button");

for (var i = 0; i < bubblyButtons.length; i++) {
    bubblyButtons[i].addEventListener('click', animateButton, false);
}


function toggleFavorite(id) {
    // Ajaxリクエストを送信してお気に入りの状態を取得
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: `/product/${id}/favorite`, // サーバーサイドでお気に入りの状態を確認するエンドポイントを指定
        type: "GET",
        // data: {id: id},
    })
        .done(function (data, status, xhr) {
            // サーバーからのレスポンスでお気に入りの状態を取得
            var isFavorite = data.isFavorite;
            // if (data === false) {
            //     data = false;
            // }

            console.log(isFavorite);

            // Ajaxリクエストを送信してお気に入りの状態を切り替える
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: `/product/${id}/favorite`,
                type: isFavorite ? 'DELETE' : 'POST', // お気に入りの状態に応じてPOSTかDELETEを選択
                // type: isFavorite === false ? 'DELETE' :  'POST',
            })
                .done(function (data, status, xhr) {
                    console.log(data);
                    // isFavorite = !isFavorite; // お気に入りの状態を反転させる
                    if (isFavorite) {
                        alert("お気に入りを解除しました");
                        $('#' + id).removeClass('favorite');
                    } else {
                        alert("お気に入りしました");
                        $('#' + id).addClass('favorite');
                    }
                })
                .fail(function (xhr, status, error) {
                    console.error(error);
                    alert('お気に入りの切り替えに失敗しました');
                });
        })
        .fail(function (xhr, status, error) {
            console.error(error);
            alert('お気に入りの状態の取得に失敗しました');
        });
}
