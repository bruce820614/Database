db['LoanStats3b-3'].aggregate(

	// Pipeline
	[
		// Stage 1
		{
			$match: {
			    "loan_status":"Charged Off"    
			}
		},

		// Stage 2
		{
			$group: {
			    _id : { verification_status:"$verification_status", home_ownership:"$home_ownership"},
			           loan_amnt_Avg: { $avg: "$loan_amnt" },
			           int_rate_Avg: { $avg: "$int_rate" },
			}
		},

	]

	// Created with 3T MongoChef, the GUI for MongoDB - https://3t.io/mongochef

);
