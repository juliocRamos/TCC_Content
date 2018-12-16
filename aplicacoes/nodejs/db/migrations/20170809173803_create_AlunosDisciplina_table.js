
exports.up = function(knex, Promise) {
  return knex.schema.createTable('alunosDisciplina', function(table){
        table.increments().primary();
        table.integer('alunoId').unsigned().references('id').inTable('alunos');
        table.integer('disciplinaId').unsigned().references('id').inTable('disciplinas');
        //table.timestamp('created_at').notNullable().defaultTo(knex.raw("CURRENT_TIMESTAMP"));
       // table.timestamp('updated_at').notNullable().defaultTo(knex.raw("CURRENT_TIMESTAMP"));
  })
};

exports.down = function(knex, Promise) {
 return knex.schema.dropTable('alunosDisciplina');
};
