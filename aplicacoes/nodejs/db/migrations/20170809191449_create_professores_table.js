
exports.up = function(knex, Promise) {
  return knex.schema.createTable("professores", function(table){
      table.increments().primary();
      table.string('nome');
  })
};

exports.down = function(knex, Promise) {
  return knex.schema.dropTable('professores');
};
