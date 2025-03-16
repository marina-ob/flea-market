describe('検索フォームのキーワード保持テスト', () => {
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

  it('検索後にキーワードが保持される', () => {
    // 1. 検索フォームに "Test" を入力
    cy.get('.search-form__input')
      .type('時計')
      .should('have.value', '時計'); // 入力が反映されていることを確認

    // 2. 検索を実行（Enterキー押下 or フォーム送信）
    cy.get('.search-form').submit();

    // 3. 検索結果ページで "Test Product" が表示されることを確認
    cy.contains('時計').should('exist');

    // 4. "マイリスト" ページへ移動
    cy.visit('http://localhost/?tab=mylist');

    // 5. 検索フォームの入力欄に "Test" が保持されていることを確認
    cy.get('.search-form__input').should('have.value', '時計');
  });
});
