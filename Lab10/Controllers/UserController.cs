using System.Data.Common;
using Lab10.Models;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using MySql.Data.MySqlClient;

namespace Lab10.Controllers
{
    public class UserController : Controller
    {
        private readonly string connectionString =
            "server=localhost;uid=root;pwd=;database=vacation;";

        // GET
        [HttpGet]
        public IActionResult Login()
        {
            if (HttpContext.Session.GetString("loggedin") == "yes") return Redirect("/Dashboard");
           return View();
        }


        [HttpGet]
        public IActionResult Logout()
        {
            HttpContext.Session.SetString("loggedin", "no");
            return Redirect("/User/Login");
        }

        [HttpPost]
        public ActionResult Verify(User user)
        {
            using (DbConnection connection = new MySqlConnection(connectionString))
            {
                connection.Open();
                using (var command = connection.CreateCommand())
                {
                    command.CommandText =
                        $"SELECT * FROM users WHERE username = '{user.Username}' and password = '{user.Password}'";
                    var dataReader = command.ExecuteReader();
                    if (dataReader.Read())
                    {
                        HttpContext.Session.SetString("loggedin", "yes");
                        ViewBag.username = user.Username;
                        return Redirect("/Dashboard");
                    }

                    return View("Error");
                }
            }
        }
    }
}

