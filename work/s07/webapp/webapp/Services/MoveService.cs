using System;
using System.Collections.Generic;
using Newtonsoft.Json;
using webapp.Models;

namespace webapp.Services
{
    public class MoveService
    {
        public static string MoveMoney(int numberFrom, int numberTo, int amount)
        {
            string message = "No message to be displayed.";
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
                    if (data[accountToMoveFrom].balance >= amount)
                    {
                        //Make transfer here
                        data[accountToMoveFrom].balance -= amount;
                        data[accountToMoveTo].balance += amount;

                        //Now back to JSON
                        string output = JsonConvert.SerializeObject(data);
                        System.IO.File.WriteAllText(@"C:/Users/Eigenaar/Documents/GitHub/websoft/work/account.json",
                            output);
                        message = "Transfer completed successfully.";
                    }
                    else
                    {
                        message = "The account to transfer from does not have a sufficient balance.";
                    }

                    break;
                }
            }

            if (!foundAccountToMoveFrom || !foundAccountToMoveTo)
            {
                message =
                    "There was trouble finding the accounts. Please check if you have the correct account numbers.";
            }

            return message;
        }
    }
}