using System.Collections.Generic;
using System.ComponentModel.DataAnnotations.Schema;
using DisciplinaModel.Model;

namespace AlunoModel.Models
{
    public class Aluno
    {
        public int Id {get; set;}
        public string Nome { get; set; }
        public string Email {get; set;}
        public int Idade {get; set;}
        public string Sexo {get; set;}

    }

}