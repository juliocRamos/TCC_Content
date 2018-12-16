using AlunoModel.Models;
using DisciplinaModel.Model;
using Microsoft.EntityFrameworkCore;
using MySql.Data.MySqlClient;

namespace Context.Models
{
    public class ApplicationDbContext : DbContext
    {
        public ApplicationDbContext(DbContextOptions<ApplicationDbContext> options):
        base(options) {}
        public DbSet<Aluno> Alunos { get; set;}
        public DbSet<Disciplina> Disciplinas { get; set;}
    }
}