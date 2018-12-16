
exports.up = function(knex, Promise) {
  return knex.schema.createTable('disciplinas', function (table) {
    table.increments().primary();
    table.string('nome');
    table.string('professor');
    table.string('periodo');
    table.string('descricao');
    table.integer('duracao');
    //table.timestamp('created_at').notNullable().defaultTo(knex.raw("CURRENT_TIMESTAMP"));
    //table.timestamp('updated_at').notNullable().defaultTo(knex.raw("CURRENT_TIMESTAMP"));
  })
};

exports.down = function(knex, Promise) {
    return knex.schema.dropTable('disciplinas');
};
