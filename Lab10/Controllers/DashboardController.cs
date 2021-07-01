using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace Lab10.Controllers
{
    public class DashboardController : Controller
    {
        // GET
        public IActionResult Index()
        {
            if (HttpContext.Session.GetString("loggedin") != "yes")
            {
                return Redirect("/User/Login");
            }
            return View();
        }
    }
}