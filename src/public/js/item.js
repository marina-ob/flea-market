document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.like-button').forEach(likeBtn => {
        likeBtn.addEventListener('click', function() {
            let productId = this.getAttribute('data-product-id');
            let likeIcon = document.getElementById(`like-icon-${productId}`);
            let likeCountElement = document.getElementById(`like-count-${productId}`);

            if (!likeIcon || !likeCountElement) {
                console.error(`エラー: like-icon-${productId} または like-count-${productId} が見つかりません`);
                return;
            }

            let isLiked = likeIcon.classList.contains('liked');
            let currentLikes = parseInt(likeCountElement.innerText, 10);

            // 仮のUI更新（先に見た目を変更）
            if (isLiked) {
                likeIcon.classList.remove('liked');
                likeCountElement.innerText = currentLikes - 1;
            } else {
                likeIcon.classList.add('liked');
                likeCountElement.innerText = currentLikes + 1;
            }

            // サーバーへリクエスト
            fetch(`/product/${productId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                console.log('レスポンス:', data);

                if (data.likeCount !== undefined) {
                    likeCountElement.innerText = data.likeCount;
                    if (data.liked) {
                        likeIcon.classList.add('liked');
                    } else {
                        likeIcon.classList.remove('liked');
                    }
                } else {
                    console.error(`エラー: likeCount がレスポンスに含まれていません`, data);
                }
            })
            .catch(error => {
                console.error(`エラー:`, error);
                // 失敗時に元の状態に戻す
                likeIcon.classList.toggle('liked', isLiked);
                likeCountElement.innerText = currentLikes;
            });
        });
    });
});
