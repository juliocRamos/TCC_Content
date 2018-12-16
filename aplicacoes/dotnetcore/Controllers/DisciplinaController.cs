using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Context.Models;
using DisciplinaModel.Model;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;

namespace tcc_dotnet.Controllers
{
    [Route("api/[controller]")]
    public class DisciplinaController : Controller
    {
        /*CONECTION TO DATABASE--->  MYSQL */
        ApplicationDbContext db;
        public DisciplinaController(ApplicationDbContext _db)
        {
            db = _db;
        }

        [HttpGet("Index")]
        public IActionResult Index()
        {
            return View("~/Views/Disciplina/IndexDisciplina.cshtml");
        }

        [HttpGet("Listar")]
        public IActionResult listar()
        {
            return View("~/Views/Disciplina/List-all-Disciplinas.cshtml");
        }

        /*
            Display a listing of the resource. 
        */
        [HttpGet("GetAll")]
        public async Task<JsonResult> getAll()
        {
            var disciplinas = await db.Disciplinas.ToListAsync();
            return Json(disciplinas);
        }

        /*
            Show the form for creating a new resource.
        */
        [HttpPost("Cadastrar")]
        public async Task<JsonResult> cadastrar(Disciplina disciplina)
        {
            using(db)
            {
                if(disciplina != null)
                {
                    db.Disciplinas.Add(disciplina);
                    await db.SaveChangesAsync();
                    var msg = "success";
                    return Json(msg);
                    
                }
                else
                {
                    var msg = "error";
                    return Json(msg);
                }
            }
        }

        /**
            Show the form for editing the specified resource. 
        */

        [HttpPost("Editar")]
        public async Task<JsonResult> editar(int? id)
        {
            using(db)
            {
                var disciplina = await db.Disciplinas.FindAsync(id);
                if(disciplina == null)
                {
                    var msg = "error";
                    return Json(msg);
                }
                return Json(disciplina);
            }      
        }

        /*
            Update the specified resource in storage.
        */

        [HttpPost("Atualizar")]
        public async Task<JsonResult> atualizar(Disciplina disciplina)
        {
            if(disciplina != null){
                db.Disciplinas.Update(disciplina);
                var result = await db.SaveChangesAsync();
                if(result == 1)
                {
                    var msg = "success";
                    return Json(msg);
                }
                else
                {
                    var msg = "error";
                    return Json(msg);
                }
            }
            else
            {
                var msg = "Sem dados para atualizar";
                return Json(msg);
            }
   
        }

        /*
            Remove the specified resource from storage.
        */

        [HttpPost("Deletar")]
        public async Task<JsonResult> deletar(int id)
        {
            var disciplina = db.Disciplinas.Where(x => x.Id == id).Single<Disciplina>();
            db.Disciplinas.Remove(disciplina);
            var result = await db.SaveChangesAsync();
            if(result == 1){
                var msg ="success";
                return Json(msg);
            }
            else{
                var msg = "error";
                return Json(msg);
            }
        }


        /*INITIALIZE DISCIPLINAS TABLE*/
        
        [HttpGet("StartDisci")]
        public List<Disciplina> StartDisci()
        {
            IQueryable<Disciplina> query = db.Disciplinas;
            
            if(!db.Disciplinas.Any())
            {
                db.Disciplinas.Add(new Disciplina{
                    Nome = "PO",
                    Duracao = 200,
                    Professor = "Binho",
                    Descricao = "TESTE DE CRIAÇÃO DA TABELA DE DISCIPLINA 01",
                    Periodo = "Noturno",
                });

                db.Disciplinas.Add(new Disciplina{
                    Nome = "Banco de Dados 2",
                    Duracao = 300,
                    Professor = "Juninho",
                    Descricao = "TESTE DE CRIAÇÃO DA TABELA DE DISCIPLINA 02",
                    Periodo = "Matutino",
                });
                db.SaveChanges();
            }
            var result = query.ToList();
            return result;
        }
    }
}