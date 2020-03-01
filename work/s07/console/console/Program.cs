using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using Newtonsoft.Json;

namespace console
{
    class Program
    {
        static void Main(string[] args)
        {
            bool keepGoing = true;
            while (keepGoing)
            {
                Console.WriteLine("---------Menu---------");
                Console.WriteLine("1. View accounts");
                Console.WriteLine("2. View account by number");
                Console.WriteLine("3. Search");
                Console.WriteLine("4. Move");
                Console.WriteLine("5. New account");
                Console.WriteLine("6. ");
                Console.WriteLine("7. Exit");
                Console.WriteLine("----------------------");
                string response = Console.ReadLine();
                switch (response)
                {
                    case "1":
                        ViewAccounts();
                        break;
                    case "2":
                        ViewAccountByNumber();
                        break;
                    case "3":
                        Search();
                        break;
                    case "4":
                        Move();
                        break;
                    case "5":
                        NewAccount();
                        break;
                    case "7":
                        keepGoing = false;
                        break;
                }
            }
        }

        private static List<Account> GetJson()
        {
            List<Account> items;
            using (StreamReader r = new StreamReader("C:/Users/Eigenaar/Documents/GitHub/websoft/work/account.json"))
            {
                string json = r.ReadToEnd();
                items = JsonConvert.DeserializeObject<List<Account>>(json);
            }

            return items;
        }

        private static void ViewAccounts()
        {
            //Loading the JSON file from the specified path using a JSON.NET library
            List<Account> items = GetJson();

            //Writing this 'pretty' table to the console
            Console.WriteLine("+--------+---------+-----------+-------+");
            Console.WriteLine("| Number | Balance |   Label   | Owner |");

            foreach (var account in items)
            {
                Console.WriteLine("+--------+---------+-----------+-------+");
                Console.Write("|");
                for (int i = 0; i < 8 - account.number.ToString().Length; i++)
                {
                    Console.Write(" ");
                }

                Console.Write(account.number);

                Console.Write("|");
                for (int i = 0; i < 9 - account.balance.ToString().Length; i++)
                {
                    Console.Write(" ");
                }

                Console.Write(account.balance);

                Console.Write("|");
                for (int i = 0; i < 11 - account.label.Length; i++)
                {
                    Console.Write(" ");
                }

                Console.Write(account.label);

                Console.Write("|");
                for (int i = 0; i < 7 - account.owner.ToString().Length; i++)
                {
                    Console.Write(" ");
                }

                Console.Write(account.owner);
                Console.WriteLine("|");
            }

            Console.WriteLine("+--------+---------+-----------+-------+");
        }

        private static void ViewAccountByNumber()
        {
            Console.Write("Please enter the number of the account you want to view:");
            var number = Console.ReadLine();

            List<Account> items = GetJson();

            bool foundAccount = false;
            foreach (var account in items)
            {
                if (account.number.ToString() == number)
                {
                    Console.WriteLine("An account was found:");
                    Console.WriteLine("Number: " + account.number);
                    Console.WriteLine("Balance: " + account.balance);
                    Console.WriteLine("Label: " + account.label);
                    Console.WriteLine("Owner: " + account.owner);
                    foundAccount = true;
                    break;
                }
            }

            if (!foundAccount)
            {
                Console.WriteLine("No account were found with that number.");
            }
        }

        private static void Search()
        {
            Console.WriteLine("Please enter your search term:");
            var searchTerm = Console.ReadLine();

            List<Account> items = GetJson();

            List<Account> searchResultsLabel = items.FindAll(
                delegate(Account account) { return account.label.Contains(searchTerm); }
            );
            List<Account> searchResultsNumber = items.FindAll(
                delegate(Account account) { return account.number.ToString().Contains(searchTerm); }
            );
            List<Account> searchResultsOwner = items.FindAll(
                delegate(Account account) { return account.owner.ToString().Contains(searchTerm); }
            );

            var searchResults = searchResultsLabel.Union(searchResultsNumber).Union(searchResultsOwner).ToList();
            if (searchResults.Count() != 0)
            {
                //Writing this 'pretty' table to the console
                Console.WriteLine("Found the following accounts:");
                Console.WriteLine("+--------+---------+-----------+-------+");
                Console.WriteLine("| Number | Balance |   Label   | Owner |");

                foreach (var account in searchResults)
                {
                    Console.WriteLine("+--------+---------+-----------+-------+");
                    Console.Write("|");
                    for (int i = 0; i < 8 - account.number.ToString().Length; i++)
                    {
                        Console.Write(" ");
                    }

                    Console.Write(account.number);

                    Console.Write("|");
                    for (int i = 0; i < 9 - account.balance.ToString().Length; i++)
                    {
                        Console.Write(" ");
                    }

                    Console.Write(account.balance);

                    Console.Write("|");
                    for (int i = 0; i < 11 - account.label.Length; i++)
                    {
                        Console.Write(" ");
                    }

                    Console.Write(account.label);

                    Console.Write("|");
                    for (int i = 0; i < 7 - account.owner.ToString().Length; i++)
                    {
                        Console.Write(" ");
                    }

                    Console.Write(account.owner);
                    Console.WriteLine("|");
                }

                Console.WriteLine("+--------+---------+-----------+-------+");
            }
            else
            {
                Console.WriteLine("Your search found no accounts.");
            }
        }

        private static void Move()
        {
            Console.WriteLine("Please enter the account number to move from:");
            var accountToMoveFromNumber = Console.ReadLine();
            Console.WriteLine("Please enter the account number to move to:");
            var accountToMoveToNumber = Console.ReadLine();
            Console.WriteLine("Please enter the amount to move:");
            var amountToMove = Console.ReadLine();
            var amountToMoveInt32 = Convert.ToInt32(amountToMove);

            List<Account> items = GetJson();

            bool foundAccountToMoveFrom = false;
            bool foundAccountToMoveTo = false;
            int accountToMoveTo = -1;
            int accountToMoveFrom = -1;

            for (int i = 0; i < items.Count; i++)
            {
                if (accountToMoveFromNumber == items[i].number.ToString())
                {
                    foundAccountToMoveFrom = true;
                    accountToMoveFrom = i;
                }

                if (accountToMoveToNumber == items[i].number.ToString())
                {
                    foundAccountToMoveTo = true;
                    accountToMoveTo = i;
                }

                if (foundAccountToMoveFrom && foundAccountToMoveTo)
                {
                    Console.WriteLine("Found both accounts. Checking balance.");
                    if (items[accountToMoveFrom].balance > amountToMoveInt32)
                    {
                        Console.WriteLine("Balance sufficient. Making transfer.");

                        //Make transfer here
                        items[accountToMoveFrom].balance -= amountToMoveInt32;
                        items[accountToMoveTo].balance += amountToMoveInt32;

                        //Now back to JSON
                        string output = JsonConvert.SerializeObject(items);
                        File.WriteAllText(@"C:/Users/Eigenaar/Documents/GitHub/websoft/work/account.json",
                            output);

                        Console.WriteLine("Transfer successfully finished.");
                    }
                    else
                    {
                        Console.WriteLine("The account to transfer from does not have a sufficient balance.");
                    }

                    break;
                }
            }

            if (!foundAccountToMoveFrom || !foundAccountToMoveTo)
            {
                Console.WriteLine(
                    "There was trouble finding the accounts. Please check if you have the correct account numbers.");
            }
        }

        private static void NewAccount()
        {
            Console.WriteLine("Please write the account number for the new account:");
            var accountNumber = Console.ReadLine();
            Console.WriteLine("Please write the account label for the new account:");
            var accountLabel = Console.ReadLine();
            Console.WriteLine("Please write the account owner for the new account:");
            var accountOwner = Console.ReadLine();

            List<Account> items = GetJson();

            bool numberTaken = false;
            foreach (var account in items)
            {
                if (account.number.ToString() == accountNumber)
                {
                    Console.WriteLine("The entered account number is not available.");
                    numberTaken = true;
                    break;
                }
            }

            if (!numberTaken)
            {
                Account createdAccount = new Account
                {
                    number = Convert.ToInt32(accountNumber),
                    balance = 0,
                    label = accountLabel,
                    owner = Convert.ToInt32(accountOwner)
                };

                items.Add(createdAccount);

                string output = JsonConvert.SerializeObject(items);
                File.WriteAllText(@"C:/Users/Eigenaar/Documents/GitHub/websoft/work/account.json",
                    output);

                Console.WriteLine("New account added. It can now be viewed by selecting 'View accounts'.");
            }
        }
    }
}