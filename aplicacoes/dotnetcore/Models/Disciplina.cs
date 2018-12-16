using System.Collections.Generic;
using System.ComponentModel.DataAnnotations.Schema;
using AlunoModel.Models;

namespace DisciplinaModel.Model
{
    public class Disciplina{
        
        public int Id { get; set; }
        public string Nome { get; set; }
        public int Duracao { get; set; }
        public string Professor { get; set; }
        public string Descricao { get; set; }
        public string Periodo { get; set;}

    }
    
}