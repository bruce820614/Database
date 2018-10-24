db['LoanStats3b-3'].aggregate(

	// Pipeline
	[
		// Stage 1
		{
			$match: {
			"loan_status": "Current"
			}
		},

		// Stage 2
		{
			$project: {
			    "member_id": 1, "last_pymnt_d": 1, "next_pymnt_d": 1, "last_pymnt_amnt": 1
			}
		},

	]

	// Created with 3T MongoChef, the GUI for MongoDB - https://3t.io/mongochef

);
