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
            List<Account> data = FileReader.GetJson();

            bool foundAccountToMoveFrom = false;
            bool foundAccountToMoveTo = false;
            int accountToMoveTo = -1;
            int accountToMoveFrom = -1;

            for (int i = 0; i < data.Count; i++)
            {
                if (numberFrom == data[i].number)
                {
                    foundAccountToMoveFrom = true;
                    accountToMoveFrom = i;
                }

                if (numberTo == data[i].number)
                {
                    foundAccountToMoveTo = true;
                    accountToMoveTo = i;
                }

                if (foundAccountToMoveFrom && foundAccountToMoveTo)
                {
                    if (data[accountToMoveFrom].balance > amount)
                    {
                        //Make transfer here
                        data[accountToMoveFrom].balance -= amount;
                        data[accountToMoveTo].balance += amount;

                        //Now back to JSON
                        string output = JsonConvert.SerializeObject(data);
                        System.IO.File.WriteAllText(@"C:/Users/Eigenaar/Documents/GitHub/websoft/work/account.json",
                            output);
                        return Ok("Transfer finished successfully.");
                    }
                    return Ok("The account to transfer from does not have a sufficient balance.");
                }
            }
            return Ok("There was trouble finding the accounts. Please check if you have the correct account numbers.");
        }
    }
}