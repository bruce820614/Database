db['LoanStats3b-3'].aggregate(

	// Pipeline
	[
		// Stage 1
		{
			$match: {
			"emp_length":"10+ years"
			}
		},

		// Stage 2
		{
			$group: {
			_id : { state:"$addr_state"},
			      loan_amnt_Avg: { $avg: "$loan_amnt" },
			      annual_inc_Avg: { $avg: "$annual_inc" },
			}
		},

		// Stage 3
		{
			$sort: {
			"annual_inc_Avg":-1
			}
		},

		// Stage 4
		{
			$limit: 5
		},

	]

	// Created with 3T MongoChef, the GUI for MongoDB - https://3t.io/mongochef

);
