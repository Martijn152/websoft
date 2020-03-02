using System;
using System.Collections.Generic;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Newtonsoft.Json;
using webapp.Models;
using webapp.Services;

namespace webapp.Pages
{
    public class MoveForm : PageModel
    {
        public string Message { get; private set; } = "";

        public void OnGet()
        {
        }

        public void OnPost()
        {
            var numberFrom = Request.Form["numberFrom"];
            var numberTo = Request.Form["numberTo"];
            var amount = Request.Form["amount"];

            Message = MoveService.MoveMoney(Convert.ToInt32(numberFrom), Convert.ToInt32(numberTo),
                Convert.ToInt32(amount));
        }
    }
}