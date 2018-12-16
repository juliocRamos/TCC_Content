
exports.up = function(knex, Promise) {
  return knex.schema.createTable('alunos', function (table) {
    table.increments().primary();
    table.string('nome');
    table.string('email');
    table.integer('idade');
    table.string('sexo');
   // table.timestamp('created_at').notNullable().defaultTo(knex.raw("CURRENT_TIMESTAMP"));
   // table.timestamp('updated_at').notNullable().defaultTo(knex.raw("CURRENT_TIMESTAMP"));
  })
};

exports.down = function(knex, Promise) {
    return knex.schema.dropTable('alunos');
};
