using System.Collections.Generic;
using System.IO;
using Newtonsoft.Json;
using webapp.Models;

namespace webapp.Services
{
    public class FileReader
    {
        public static List<Account> GetJson()
        {
            List<Account> items;
            using (StreamReader r = new StreamReader("C:/Users/Eigenaar/Documents/GitHub/websoft/work/account.json"))
            {
                string json = r.ReadToEnd();
                items = JsonConvert.DeserializeObject<List<Account>>(json);
            }
            return items;
        }
    }
}