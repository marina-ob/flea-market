describe('like_button Test', () => {
  before(() => {
    cy.visit('http://localhost/login');

    cy.get('input[name="email"]').type('test@example.com');
    cy.get('input[name="password"]').type('password');
    cy.get('button[type="submit"]').click();

    cy.url().should('eq', 'http://localhost/');
  });

  it('いいねボタンを押すとアイコンの色が変わる', () => {
    cy.visit('http://localhost/item/1');

    cy.get('.like-button')
      .find('.like-icon')
      .then(($icon) => {
        const beforeFilter = $icon.css('filter');

        cy.wrap($icon)
          .should('not.have.class', 'liked')
          .parent()
          .click()
          .find('.like-icon')
          .should('have.class', 'liked')
          .then(($iconAfter) => {
            const afterFilter = $iconAfter.css('filter');

            expect(beforeFilter).not.to.equal(afterFilter);
          });
      });
  });
});
