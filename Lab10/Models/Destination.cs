using System.ComponentModel.DataAnnotations;

namespace Lab10.Models
{
    public class Destination
    {
        public int id { get; set; }
        
        [Required]
        public string city { get; set; }

        [Required] 
        public string country { get; set; }
        
        [Required]
        public string description { get; set; }
        
        [Required]
        public string targets { get; set; }
        
        [Required]
        public float cost { get; set; }
        
        
    }
}