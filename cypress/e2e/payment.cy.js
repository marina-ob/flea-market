describe('Payment Select Test', () => {
  before(() => {
    // ログイン処理を追加
    cy.visit('http://localhost/login'); // ログインページへ訪問

    // ログイン情報を入力して送信
    cy.get('input[name="email"]').type('test@example.com');  // 使うメールアドレスに変更
    cy.get('input[name="password"]').type('test1234');  // パスワードを設定
    cy.get('button[type="submit"]').click();  // ログインボタンをクリック

    // ログイン後、メインページへ遷移（遷移先URLを確認して必要なら変更）
    cy.url().should('eq', 'http://localhost/'); // メインページのURLに変更
  });

  it('選択した支払い方法が即反映されるか', () => {
    // 1. ページにアクセスする
    cy.visit('http://localhost/purchase/1'); // 適切なURLに変更

    // 2. 支払い方法の選択肢を選ぶ
    cy.get('select[name="payment"]').select('カード払い'); // 'カード払い'を選択

    // 3. <span id="selected-payment">の中身が「カード払い」に変わったかを確認
    cy.get('#selected-payment').should('have.text', 'カード払い');
  });
});
