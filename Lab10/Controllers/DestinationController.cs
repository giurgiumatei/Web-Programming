using System;
using System.Collections.Generic;
using System.Data.Common;
using Ganss.XSS;
using Lab10.Models;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using MySql.Data.MySqlClient;

namespace Lab10.Controllers
{
    public class DestinationController : Controller
    {
        private readonly string connectionString =
            "server=localhost;uid=root;pwd=;database=vacation;";

        private readonly HtmlSanitizer _sanitizer = new();

        // GET
        public IActionResult Index()
        {
            return View();
        }

        [HttpGet]
        public IActionResult Add()
        {
            if (HttpContext.Session.GetString("loggedin") != "yes") return Redirect("/User/Login");

            return View();
        }

        [HttpPost]
        public IActionResult Add(Destination destination)
        {
            if (HttpContext.Session.GetString("loggedin") != "yes") return Redirect("User/Login");

            destination.city = _sanitizer.Sanitize(destination.city);
            destination.country = _sanitizer.Sanitize(destination.country);
            destination.description = _sanitizer.Sanitize(destination.description);
            destination.cost = float.Parse(_sanitizer.Sanitize(destination.cost.ToString("N4")));
            destination.targets = _sanitizer.Sanitize(destination.targets);

            var sql =
                $"INSERT INTO data(city, country, targets, description, cost) VALUES " +
                $"('{destination.city}', '{destination.country}', '{destination.targets}'," +
                $" '{destination.description}', {destination.cost})";

            using (DbConnection connection = new MySqlConnection(connectionString))
            {
                connection.Open();
                using (var command = connection.CreateCommand())
                {
                    command.CommandText = sql;
                    var dataReader = command.ExecuteReader();
                }
            }

            return Redirect("/Dashboard");
        }

        [HttpGet]
        public IActionResult Delete(int id)
        {
            if (HttpContext.Session.GetString("loggedin") != "yes") return Redirect("User/Login");

            var sql = "SELECT COUNT(*) FROM data";
            using (DbConnection connection = new MySqlConnection(connectionString))
            {
                connection.Open();
                using (var command = connection.CreateCommand())
                {
                    command.CommandText = sql;
                    var numberOfResults = Convert.ToInt32(command.ExecuteScalar());
                    var resultsPerPage = 4;
                    var pageSelected = 1;
                    if (id != 0) pageSelected = id;

                    var firstPageResult = (pageSelected - 1) * resultsPerPage;
                    var pageNumber = numberOfResults / resultsPerPage;
                    if (numberOfResults % resultsPerPage != 0) pageNumber += 1;
                    var query = $"SELECT * FROM data LIMIT {resultsPerPage} OFFSET {firstPageResult}";

                    var results = new List<Destination>();
                    command.CommandText = query;
                    DbDataReader dataReader = command.ExecuteReader();
                    while (dataReader.Read())
                    {
                        results.Add(new Destination{id = int.Parse(dataReader.GetValue(0).ToString()), 
                            city = dataReader.GetValue(1).ToString(), 
                            country = dataReader.GetValue(2).ToString(), 
                            description = dataReader.GetValue(3).ToString(), 
                            targets = dataReader.GetValue(4).ToString(), 
                            cost = float.Parse(dataReader.GetValue(5).ToString())});
                    }

                    var resultPair =
                        new Tuple<List<Destination>, Tuple<int, int>>(results,
                            new Tuple<int, int>(pageNumber, pageSelected));
                    return View(resultPair);
                }
            }
        }

        [HttpGet]
        public IActionResult DeleteSpecific(int id)
        {
            if (HttpContext.Session.GetString("loggedin") != "yes") return Redirect("User/Login");
            var sql = $"DELETE FROM data where id = {id}";
            
            using (DbConnection connection = new MySqlConnection(connectionString))
            {
                connection.Open();
                using (DbCommand command = connection.CreateCommand())
                {
                    command.CommandText = sql;
                    DbDataReader dr = command.ExecuteReader();
                }
            }
            
            return Redirect("/Dashboard");
        }

        [HttpGet]
        public IActionResult Update(int id)
        {
           if (HttpContext.Session.GetString("loggedin") != "yes") return Redirect("User/Login");

            var sql = "SELECT COUNT(*) FROM data";
            using (DbConnection connection = new MySqlConnection(connectionString))
            {
                connection.Open();
                using (var command = connection.CreateCommand())
                {
                    command.CommandText = sql;
                    var numberOfResults = Convert.ToInt32(command.ExecuteScalar());
                    var resultsPerPage = 4;
                    var pageSelected = 1;
                    if (id != 0) pageSelected = id;

                    var firstPageResult = (pageSelected - 1) * resultsPerPage;
                    var pageNumber = numberOfResults / resultsPerPage;
                    if (numberOfResults % resultsPerPage != 0) pageNumber += 1;
                    var query = $"SELECT * FROM data LIMIT {resultsPerPage} OFFSET {firstPageResult}";

                    var results = new List<Destination>();
                    command.CommandText = query;
                    DbDataReader dataReader = command.ExecuteReader();
                    while (dataReader.Read())
                    {
                        results.Add(new Destination{id = int.Parse(dataReader.GetValue(0).ToString()), 
                            city = dataReader.GetValue(1).ToString(), 
                            country = dataReader.GetValue(2).ToString(), 
                            description = dataReader.GetValue(3).ToString(), 
                            targets = dataReader.GetValue(4).ToString(), 
                            cost = float.Parse(dataReader.GetValue(5).ToString())});
                    }

                    var resultPair =
                        new Tuple<List<Destination>, Tuple<int, int>>(results,
                            new Tuple<int, int>(pageNumber, pageSelected));
                    return View(resultPair);
                }
            }
        }

        [HttpGet]
        public IActionResult UpdateForm(int id)
        {
            if (HttpContext.Session.GetString("loggedin") != "yes")
                return Redirect("/User/Login");

            var sql = $"SELECT * FROM data WHERE id = {id}";
            using (DbConnection conn = new MySqlConnection(connectionString))
            {
                conn.Open();
                using (DbCommand command = conn.CreateCommand())
                {
                    command.CommandText = sql;
                    DbDataReader dataReader = command.ExecuteReader();
                    if (dataReader.Read())
                    {
                        Destination destination = new Destination
                        {
                            id = int.Parse(dataReader.GetValue(0).ToString()), city = dataReader.GetValue(1).ToString(),
                            country = dataReader.GetValue(2).ToString(), description = dataReader.GetValue(3).ToString(),
                            targets = dataReader.GetValue(4).ToString(), cost = float.Parse(dataReader.GetValue(5).ToString())
                        };
                        return View(destination);
                    }
                }
            }

            return View();
        }

        [HttpPost]
        public IActionResult UpdateForm(Destination destination)
        {
            if (HttpContext.Session.GetString("loggedin") != "yes")
                return Redirect("/User/Login");
            
            destination.city = _sanitizer.Sanitize(destination.city);
            destination.country = _sanitizer.Sanitize(destination.country);
            destination.description = _sanitizer.Sanitize(destination.description);
            destination.cost = float.Parse(_sanitizer.Sanitize(destination.cost.ToString("N4")));
            destination.targets = _sanitizer.Sanitize(destination.targets);
            
            var sql =
                $"Update data SET city='{destination.city}', " +
                $"country='{destination.country}', " +
                $"targets='{destination.targets}', " +
                $"description='{destination.description}', " +
                $"cost={destination.cost} WHERE id={destination.id}";
            
            using (DbConnection connection = new MySqlConnector.MySqlConnection(connectionString))
            {
                connection.Open();
                using (DbCommand command = connection.CreateCommand())
                {
                    command.CommandText = sql;
                    command.ExecuteReader();
                }
            }
            
            return Redirect("/Dashboard");
            
        }

        [HttpGet]
        public IActionResult Browse(int id)
        {
            if (HttpContext.Session.GetString("loggedin") != "yes") return Redirect("User/Login");

            var sql = "SELECT COUNT(*) FROM data";
            using (DbConnection connection = new MySqlConnection(connectionString))
            {
                connection.Open();
                using (var command = connection.CreateCommand())
                {
                    command.CommandText = sql;
                    var numberOfResults = Convert.ToInt32(command.ExecuteScalar());
                    var resultsPerPage = 4;
                    var pageSelected = 1;
                    if (id != 0) pageSelected = id;

                    var firstPageResult = (pageSelected - 1) * resultsPerPage;
                    var pageNumber = numberOfResults / resultsPerPage;
                    if (numberOfResults % resultsPerPage != 0) pageNumber += 1;
                    var query = $"SELECT * FROM data LIMIT {resultsPerPage} OFFSET {firstPageResult}";

                    var results = new List<Destination>();
                    command.CommandText = query;
                    DbDataReader dataReader = command.ExecuteReader();
                    while (dataReader.Read())
                    {
                        results.Add(new Destination{id = int.Parse(dataReader.GetValue(0).ToString()), 
                            city = dataReader.GetValue(1).ToString(), 
                            country = dataReader.GetValue(2).ToString(), 
                            description = dataReader.GetValue(3).ToString(), 
                            targets = dataReader.GetValue(4).ToString(), 
                            cost = float.Parse(dataReader.GetValue(5).ToString())});
                    }

                    var resultPair =
                        new Tuple<List<Destination>, Tuple<int, int>>(results,
                            new Tuple<int, int>(pageNumber, pageSelected));
                    return View(resultPair);
                }
            }
        }

        [HttpGet]
        public String BrowseSpecific(string city, int id)
        {
            var sql = "SELECT COUNT(*) FROM data";
            if (city.Length > 0)
            {
                sql = $"SELECT COUNT(*) FROM data WHERE data.city LIKE '{city}%'";
            }

            using (DbConnection connection = new MySqlConnection(connectionString))
            {
                connection.Open();
                using (DbCommand command = connection.CreateCommand())
                {
                    command.CommandText = sql;
                    int numberOfResults = Convert.ToInt32(command.ExecuteScalar());
                    var resultsPerPage = 4;
                    var pageSelected = 1;
                    if (id != 0) pageSelected = id;

                    var firstPageResult = (pageSelected - 1) * resultsPerPage;
                    var pageNumber = numberOfResults / resultsPerPage;
                    if (numberOfResults % resultsPerPage != 0) pageNumber += 1;
                    var query =
                        $"SELECT * FROM data WHERE data.city LIKE '{city}%'" +
                        $" LIMIT {resultsPerPage} OFFSET {firstPageResult}";

                    List<Destination> results = new List<Destination>();
                    command.CommandText = query;
                    DbDataReader dataReader = command.ExecuteReader();
                    while (dataReader.Read())
                    {
                        results.Add(new Destination{id = int.Parse(dataReader.GetValue(0).ToString()), 
                            city = dataReader.GetValue(1).ToString(), 
                            country = dataReader.GetValue(2).ToString(), 
                            description = dataReader.GetValue(3).ToString(), 
                            targets = dataReader.GetValue(4).ToString(), 
                            cost = float.Parse(dataReader.GetValue(5).ToString())});
                    }

                    var resultPair = new Tuple<List<Destination>, Tuple<int, int>>(results, new Tuple<int, int>(pageNumber, pageSelected));
                    return Newtonsoft.Json.JsonConvert.SerializeObject(resultPair);
                    
                }
            }
        }
    }
}