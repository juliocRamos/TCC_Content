using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using AlunoModel.Models;
using Context.Models;
using Microsoft.AspNetCore.Mvc;

namespace tcc_dotnet.Controllers
{
    [Route("api/[controller]")]
    public class AlunoController : Controller
    {
        /*CONECTION TO DATABASE--->  MYSQL */
        ApplicationDbContext db;
        public AlunoController(ApplicationDbContext _db)
        {
            db = _db;
        }

        [HttpGet("Index")]
        public IActionResult index()
        {
            return View("~/Views/Aluno/IndexAluno.cshtml");
        }

        [HttpGet("Listar")]
        public IActionResult listar()
        {
            return View("~/Views/Aluno/List-all-alunos.cshtml");
        }

        [HttpPost("Create")]
        public JsonResult create(Aluno aluno)
        {
            using(db)
            {
                var alunos = db.Alunos.Add(aluno);
                db.SaveChanges();
                return Json(alunos);
            }
        }

        [HttpGet("Getall")]
        public JsonResult getall()
        {
            using(db)
            {
                var alunos = db.Alunos.ToList();
                return Json(alunos);
            }
        }

        [HttpPost("GetAluno")]
        public JsonResult getAluno(int id)
        {
            using(db)
            {
                var alunos = db.Alunos.Find(id);
                if(alunos == null)
                {
                    var msg = "Erro ao buscar o Aluno";
                    return Json(msg);
                }
                return Json(alunos);
            }
        }

        //Alterar um dado especifico do banco.
        [HttpPost("Update")]
        public JsonResult update(Aluno aluno)
        {
            db.Alunos.Update(aluno);
            var result = db.SaveChanges();
            if(result == 1)
            {
                var msg = "Alterado";
                return Json(msg);
            }
            else
            {
                var msg = "Erro";
                return Json(msg);
            }
        }

        //Remover um dado especifico do banco.
        [HttpPost("Destroy")]
        public JsonResult destroy(int id)
        {
            var alunos = db.Alunos.Where(a => a.Id == id).Single<Aluno>();
            db.Alunos.Remove(alunos);
            var result = db.SaveChanges();
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
    }
}