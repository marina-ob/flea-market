describe('Payment Select Test', () => {
  before(() => {
    cy.visit('http://localhost/login');

    cy.get('input[name="email"]').type('test@example.com');
    cy.get('input[name="password"]').type('password');
    cy.get('button[type="submit"]').click();

    cy.url().should('eq', 'http://localhost/');
  });

  it('選択した支払い方法が即反映されるか', () => {
    cy.visit('http://localhost/purchase/1');

    cy.get('select[name="payment"]').select('カード払い');

    cy.get('#selected-payment').should('have.text', 'カード払い');
  });
});
