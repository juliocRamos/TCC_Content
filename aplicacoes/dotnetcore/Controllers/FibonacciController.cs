using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Context.Models;
using DisciplinaModel.Model;
using Microsoft.AspNetCore.Mvc;

namespace learning_dotnetcore.Controllers

{
    [Route("api/[controller]")]
    public class FibonacciController : Controller
    {
        [HttpGet("Index")]
        public IActionResult index()
        {
            return View("~/Views/Fibonacci/IndexFibonacci.cshtml");
        }

        /*
            Calculate Fibonacci.
        */
        [HttpGet("generateSequence")]
        public async Task<JsonResult> fibonacciRecursive()
        {
            int[] fib = new int[46];
            for (int i = 0; i <= 45; i++) {
                fib[i] = await Task.Run(() => FibonacciController.fibonacci(i));
            }
            return Json(fib);
        }

        private static int fibonacci(int num)
        {
            if (num == 0){
                return 0;
            }
            if (num == 1) {
                return 1;
            }
            return FibonacciController.fibonacci(num -1) + FibonacciController.fibonacci(num - 2);
        }
    }
}