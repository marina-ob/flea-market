describe('検索フォームのキーワード保持テスト', () => {
  before(() => {
    cy.visit('http://localhost/login'); //

    cy.get('input[name="email"]').type('test@example.com');
    cy.get('input[name="password"]').type('password');
    cy.get('button[type="submit"]').click();

    cy.url().should('eq', 'http://localhost/');
  });

  it('検索後にキーワードが保持される', () => {
    cy.get('.search-form__input')
      .type('時計')
      .should('have.value', '時計');
    
    cy.get('.search-form').submit();

    cy.contains('時計').should('exist');

    cy.visit('http://localhost/?tab=mylist');

    cy.get('.search-form__input').should('have.value', '時計');
  });
});
