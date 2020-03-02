using System.Collections.Generic;
using Microsoft.AspNetCore.Mvc;
using Newtonsoft.Json;
using webapp.Models;
using webapp.Services;

namespace webapp.Controllers
{
    public class Api : Controller
    {
        // GET
        [HttpGet("/accounts")]
        public ActionResult Accounts()
        {
            List<Account> data = FileReader.GetJson();
            return Ok(data);
        }

        [HttpGet("/accounts/{number}")]
        public ActionResult GetSpecificAccount(int number)
        {
            List<Account> data = FileReader.GetJson();
            foreach (var account in data)
            {
                if (account.number == number)
                {
                    return Ok(account);
                }
            }

            return Ok("No such account exists.");
        }

        [HttpPost("/accounts/{numberFrom}/{numberTo}/{amount}")]
        public ActionResult GetSpecificAccount(int numberFrom, int numberTo, int amount)
        {
            return Ok(MoveService.MoveMoney(numberFrom,numberFrom,amount));
        }
    }
}