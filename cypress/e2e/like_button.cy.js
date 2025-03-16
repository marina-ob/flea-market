describe('いいねボタンの動作テスト', () => {
  beforeEach(() => {
    cy.visit('http://localhost/item/1'); // 適切なURLに変更
  });

  it('いいねボタンを押すとアイコンの色が変わる', () => {
    cy.get('.like-button') // いいねボタンを取得
      .find('.like-icon') // アイコンを取得
      .then(($icon) => {
        // クリック前の `filter` 値を取得
        const beforeFilter = $icon.css('filter');

        cy.wrap($icon)
          .should('not.have.class', 'liked') // 最初は `liked` クラスがないことを確認
          .parent() // ボタン要素に戻る
          .click() // クリック
          .find('.like-icon') // 再びアイコンを取得
          .should('have.class', 'liked') // `liked` クラスが追加されたことを確認
          .then(($iconAfter) => {
            // クリック後の `filter` 値を取得
            const afterFilter = $iconAfter.css('filter');

            // `filter` の値が変わったことを確認
            expect(beforeFilter).not.to.equal(afterFilter);
          });
      });
  });
});
